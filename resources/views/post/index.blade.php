<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1>Posts</h1>

        @if($posts->isEmpty())
            <p>No hay posts disponibles.</p>
        @else
            <ul>
                @foreach($posts as $post)
                    <li>
                        <h2>{{ $post->titulo }}</h2>
                        <p><strong>Contenido:</strong> {{ $post->descripcion }}</p>
                        <p><strong>Creado:</strong> {{ $post->created_at->format('d-m-Y H:i') }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('post/store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('Deja tu comentario') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
