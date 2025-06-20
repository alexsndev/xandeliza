# INSTRUÇÕES DO PROJETO

Este arquivo serve como referência para a IA (e também para desenvolvedores, se necessário) sobre as regras, padrões e boas práticas deste projeto.

## 1. Como criar uma nova seção habilitável/desabilitável
- Sempre que criar uma nova seção (ex: depoimentos, blog, etc), adicione uma configuração boolean no banco de dados (tabela `site_configs`) com o padrão `show_nome_da_secao`.
- Exemplo: para uma seção "Depoimentos", crie a chave `show_testimonials`.
- Adicione o switch no dropdown da engrenagem no menu, usando o mesmo padrão dos outros toggles.
- No Blade, condicione a exibição da seção usando:
  ```blade
  @if(!empty($configs['show_testimonials']) && $configs['show_testimonials'] == '1')
      <!-- Seção Depoimentos -->
  @endif
  ```

## 2. Como adicionar uma nova configuração de cor
- Adicione uma nova chave do tipo `color` na tabela `site_configs`.
- Exemplo: `testimonial_bg_color` para cor de fundo dos depoimentos.
- Adicione o input de cor no painel administrativo e, se necessário, no dropdown de cores do menu.
- Use a cor no CSS inline ou em variáveis CSS no Blade.

## 3. Como tornar campos editáveis pela view
- Use o componente `<x-edit-overlay section="nome" configKey="chave"> ... </x-edit-overlay>` ao redor do conteúdo editável.
- O campo deve existir em `site_configs` e ser do tipo adequado (text, textarea, image, etc).
- Exemplo:
  ```blade
  <x-edit-overlay section="about" configKey="about_text">
      {{ $configs['about_text'] ?? 'Texto padrão' }}
  </x-edit-overlay>
  ```

## 4. Como criar comandos artisan customizados
- Crie um arquivo em `app/Console/Commands/NomeDoComando.php`.
- Registre o comando em `app/Console/Kernel.php`.
- Use para tarefas administrativas, debug, ou manutenção.

## 5. Organização dos arquivos
- Controllers: `app/Http/Controllers/`
- Models: `app/Models/`
- Views: `resources/views/`
- Componentes Blade: `resources/views/components/`
- Migrations: `database/migrations/`
- Seeders: `database/seeders/`
- Comandos artisan: `app/Console/Commands/`

## 6. Checklist para novas features
- [ ] Adicionar config de visibilidade se for uma nova seção
- [ ] Adicionar configs de cor se necessário
- [ ] Tornar campos editáveis via overlay se for conteúdo dinâmico
- [ ] Atualizar este arquivo se criar um novo padrão

## 7. Comandos úteis
- Ver valor de uma config: `php artisan siteconfig:show chave`
- Adicionar show_hero: `php artisan siteconfig:add-show-hero`

## 8. Observações
- Sempre que possível, siga o padrão das seções já existentes.
- Este arquivo é voltado para a IA, mas pode ser útil para devs humanos também.
- Se criar um novo padrão, documente aqui! 