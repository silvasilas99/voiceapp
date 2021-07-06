<x-guest-layout>
    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <section class="flex flex-col md:flex-row h-screen items-center">

        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
          <img src="https://blog.leucotron.com.br/wp-content/uploads/2017/12/desmistificando-o-pabx-entenda-os-beneficios-e-aplicacoes.jpeg" alt="" class="w-full h-full object-cover">
        </div>

        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
            <div class="w-full h-100">
                <div class="p-6">
                    <a href="index.html" class="flex items-center justify-center text-blue-700 text-3xl font-semibold uppercase hover:text-gray-300">VoiceApp</a>
                </div>

                <form class="mt-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div>
                        <label class="block text-gray-700">E-mail</label>
                        <input type="email" name="email" :value="old('email')" placeholder="Insira seu e-mail" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700">Senha</label>
                        <input type="password"name="password" autocomplete="current-password" placeholder="Insira sua senha" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" required>
                    </div>

                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Lembre-me</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">
                        Entrar
                    </button>
                </form>

                <hr class="my-6 border-gray-300 w-full">

                <p class="mt-8">Precisa de uma conta? <a href="#" class="text-blue-500 hover:text-blue-700 font-semibold">Contate o suporte</a></p>

            </div>
        </div>

    </section>
</x-guest-layout>
