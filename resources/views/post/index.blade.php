<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <center> 
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Posts</h1>
        </center>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($posts->isEmpty())
            <p>No hay posts disponibles.</p>
        @else
            <ul>
                @foreach($posts as $post)
                    <li class="bg-white shadow-md rounded-md p-4 mb-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $post->titulo }}</h2>
                        <p class="text-gray-700 mb-2">{{ $post->descripcion }}</p>
                        <p class="text-gray-500">Creado: {{ $post->created_at->format('d-m-Y H:i') }}</p>

                        <h3 class="text-lg font-semibold mt-4">Comentarios</h3>

                        @if($post->comentarios->isEmpty())
                            <p>No hay comentarios aún.</p>
                        @else
                            <ul class="list-disc list-inside">
                                @foreach($post->comentarios as $comentario)
                                    <li class="mt-2">
                                        <p class="text-gray-600">{{ $comentario->descripcion }}</p>
                                        <p class="text-gray-500 text-sm">Por: {{ $comentario->user->name }} el {{ $comentario->created_at->format('d-m-Y H:i') }}</p>
                                        <div class="flex space-x-2 mt-2">
                                            <!-- Botón para editar el comentario -->
                                            <button class="text-blue-500 hover:text-blue-700" onclick="toggleEditForm('{{ $comentario->id }}')">Editar</button>

                                            <!-- Formulario para editar el comentario -->
                                            <form id="edit-form-{{ $comentario->id }}" action="{{ route('comentario/update', $comentario) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="descripcion" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">{{ $comentario->descripcion }}</textarea>
                                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2 text-red-500" />
                                                <x-primary-button class="mt-2">{{ __('Actualizar') }}</x-primary-button>
                                            </form>

                                            <!-- Botón para borrar el comentario -->
                                            {{-- <form action="{{ route('comentario/destroy', $comentario) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-primary-button class="text-red-500 hover:text-red-700">{{ __('Borrar') }}</x-primary-button>
                                            </form> --}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Formulario para dejar un comentario -->
                        <form method="POST" action="{{ route('comentario/store') }}" class="mt-2">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea
                                name="descripcion"
                                placeholder="{{ __('Deja tu comentario') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
                            >{{ old('descripcion') }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2 text-red-500" />
                            <x-primary-button class="mt-2">{{ __('Comentar') }}</x-primary-button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <script>
        function toggleEditForm(commentId) {
            var form = document.getElementById('edit-form-' + commentId);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
