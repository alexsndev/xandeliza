<?php

namespace App\Http\Controllers;

use App\Models\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SiteConfigController extends Controller
{
    /**
     * Construtor
     */
    public function __construct()
    {
        // Os middleware são definidos nas rotas
    }

    /**
     * Exibe a página de configurações do site
     */
    public function index()
    {
        // Agrupa as configurações por grupo
        $configGroups = [
            'general' => SiteConfig::getGroup('general'),
            'hero' => SiteConfig::getGroup('hero'),
            'services' => SiteConfig::getGroup('services'),
            'packages' => SiteConfig::getGroup('packages'),
            'about' => SiteConfig::getGroup('about'),
            'contact' => SiteConfig::getGroup('contact'),
            'social' => SiteConfig::getGroup('social'),
        ];

        return view('admin.site-config.index', compact('configGroups'));
    }

    /**
     * Atualiza as configurações do site
     */
    public function update(Request $request)
    {
        $configs = SiteConfig::all();

        foreach ($configs as $config) {
            $key = $config->key;

            // Permitir upload para qualquer campo *_icon
            if ((Str::endsWith($key, '_icon') || $config->type === 'image') && $request->hasFile($key)) {
                $file = $request->file($key);
                $filename = Str::slug($key) . '-' . time() . '.' . $file->getClientOriginalExtension();
                try {
                    $file->move(public_path('uploads'), $filename);
                    $config->value = '/uploads/' . $filename;
                } catch (\Exception $e) {
                    report($e);
                }
            } else if ($request->has($key)) {
                $config->value = $request->input($key);
            }
            $config->save();
        }

        return redirect()->route('admin.site-config.index')
            ->with('success', 'Configurações atualizadas com sucesso!');
    }

    /**
     * Exibe a página de edição de uma seção específica
     */
    public function editSection($section)
    {
        $configs = SiteConfig::getGroup($section);
        
        if ($configs->isEmpty()) {
            abort(404);
        }

        return view('admin.site-config.edit-section', [
            'section' => $section,
            'configs' => $configs,
            'sectionTitle' => $this->getSectionTitle($section)
        ]);
    }

    /**
     * Atualiza as configurações de uma seção específica
     */
    public function updateSection(Request $request, $section)
    {
        $configs = SiteConfig::getGroup($section);
        
        foreach ($configs as $config) {
            $key = $config->key;

            if ($config->type === 'image' && $request->hasFile($key)) {
                // Processa o upload da imagem
                $file = $request->file($key);
                $filename = Str::slug($key) . '-' . time() . '.' . $file->getClientOriginalExtension();
                
                try {
                    // Salva o arquivo diretamente na pasta public/uploads
                    $file->move(public_path('uploads'), $filename);
                    $config->value = '/uploads/' . $filename;
                } catch (\Exception $e) {
                    report($e);
                }
            } else if ($request->has($key)) {
                // Atualiza o valor do campo
                $config->value = $request->input($key);
            }

            $config->save();
        }

        return redirect()->route('admin.site-config.edit-section', $section)
            ->with('success', 'Configurações atualizadas com sucesso!');
    }

    /**
     * Retorna o título da seção
     */
    private function getSectionTitle($section)
    {
        $titles = [
            'general' => 'Configurações Gerais',
            'hero' => 'Seção Principal (Hero)',
            'services' => 'Serviços',
            'packages' => 'Nossos Pacotes',
            'about' => 'Sobre Nós',
            'contact' => 'Contato',
            'social' => 'Redes Sociais',
        ];

        return $titles[$section] ?? ucfirst($section);
    }

    /**
     * Atualiza a visibilidade de uma seção via AJAX
     */
    public function toggleSection(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'required|in:0,1',
        ]);
        $key = $request->input('key');
        $value = $request->input('value');
        $config = SiteConfig::where('key', $key)->first();
        if (!$config) {
            // Se não existir, cria
            $config = new SiteConfig();
            $config->key = $key;
            $config->type = 'text';
        }
        $config->value = $value;
        $config->save();
        // Limpa cache se necessário
        Cache::forget('site_configs');
        return response()->json(['success' => true]);
    }
}