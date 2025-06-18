<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.categories.form')
                    <div class="mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 