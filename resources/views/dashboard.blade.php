@extends('main')

@section('content')
    <div class="flex flex-wrap mt-3">
        <div class="w-full lg:mt-0 pr-0 lg:pr-2">
            <div class="sm:flex sm:justify-between">
                <div class="flex items-center">
                    <p class="text-xl pb-3 flex items-center"> Resumo de ligações </p>
                </div>
                <div class="mt-2 sm:mt-0">
                    <button class="modal-open flex items-center text-white bg-blue-600 rounded px-2 py-1 hover:bg-blue-500 focus:outline-none focus:shadow-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span class="ml-1 text-sm">Filtrar</span>
                    </button>
                </div>
            </div>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="answered" width="400" height="80"></canvas>
                <canvas id="no_answer" width="400" height="80"></canvas>
            </div>
        </div>

        {{--Modal--}}
        <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                </div>
                {{-- Add margin if you want to see some of the overlay behind the modal--}}
                <div class="modal-content py-4 text-left px-6">
                    {{--Title--}}
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Filtre suas ligações</p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Form body --}}
                    <div class="grid  gap-8 grid-cols-1">
                        <div class="flex flex-col ">
                            <div class="mt-5">
                                <div class="form">

                                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2"> Data de inicio <abbr title="required">*</abbr></label>
                                            <input placeholder="Company Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="date" name="start_data" id="start_data">
                                            <p class="text-red text-xs hidden">Por favor, insira a data de inicio.</p>
                                        </div>
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2"> Data de fim <abbr title="required">*</abbr></label>
                                            <input placeholder="Email ID" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="date" name="end_data" id="end_data">
                                            <p class="text-red text-xs hidden">Por favor, insira a data final.</p>
                                        </div>
                                    </div>

                                    <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                        <div class="w-full flex flex-col mb-3">
                                            <label class="font-semibold text-gray-600 py-2">Grupo de chamada</label>
                                            <select class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full" name="ringgroup" id="ringgroup">
                                                <option value="">Selecione o grupo...</option>
                                                <option value="">Suporte</option>
                                                <option value="">Administrativo</option>
                                                <option value="">Financeiro</option>
                                                <option value="">Recursos Humanos</option>
                                            </select>
                                        </div>

                                        <div class="w-full flex flex-col mb-3">
                                            <label class="font-semibold text-gray-600 py-2">Tipo</label>
                                            <select class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full" name="type" id="type">
                                                <option value="">Selecione o tipo...</option>
                                                <option value="">Entrante</option>
                                                <option value="">Sainte</option>
                                                <option value="">Interna</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-3 space-y-2 w-full text-xs">
                                        <label class="font-semibold text-gray-600 py-2">Status</label>
                                        <select class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full" name="status" id="status">
                                            <option value="">Selecione o status...</option>
                                            <option value="">Atendida</option>
                                            <option value="">Perdida</option>
                                            <option value="">Ocupada</option>
                                            <option value="">Congestionada</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">Origem</label>
                                        <input placeholder="Telefone ou ramal de origem" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="src" id="src">
                                    </div>

                                    <div class="w-full flex flex-col mb-3">
                                        <label class="font-semibold text-gray-600 py-2">Destino</label>
                                        <input placeholder="Telefone ou ramal de destino" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="dst" id="dst">
                                    </div>
                                </div>
                                <p class="text-xs text-red-500 text-right my-3">
                                    Os campos obrigatórios estão marcados com <abbr title="Required field">*</abbr>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{--Footer--}}
                    <div class="flex justify-end pt-2">
                        <button class="modal-close px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Cancelar</button>
                        <button class="px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Go</button>
                    </div>
            </div>
            </div>
        </div>

        <div class="w-full mt-5 lg:w-1/2 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center">
                Chamadas de hoje
            </p>
            <div class="p-6 rounded shadow bg-white">
                <canvas id="doughnut" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="w-full mt-5 lg:w-1/2 pr-0 lg:pr-2">
            <p class="text-xl pb-3 flex items-center">
                Atividades de comunicação
            </p>
            <div class="rounded shadow bg-white">
                <div class="bg-white rounded-lg min-w-max w-full">
                    <ul class="divide-y divide-gray-300">
                        <li class="p-4 hover:bg-gray-50 cursor-pointer sm:flex sm:justify-between">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    Troncos:
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span>10 ativos, 5 desativados, 15 no total</span>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50 cursor-pointer sm:flex sm:justify-between">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    Ramais:
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span>102 ativos, 14 desativados, 116 no total</span>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50 cursor-pointer sm:flex sm:justify-between">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    Aguardando na fila:
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span>0 no total</span>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50 cursor-pointer sm:flex sm:justify-between">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    Chamadas:
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span>50 no total</span>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50 cursor-pointer sm:flex sm:justify-between">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    Canais no total:
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span>100 canais</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="w-full lg:mt-0 pr-0 lg:pr-2">
            <p class="text-xl mt-5 pb-3 flex items-center">
                Ligações ao vivo
            </p>
            <div class="rounded shadow bg-white">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-white text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Origem</th>
                            <th class="py-3 px-6 text-left">Destino</th>
                            <th class="py-3 px-6 text-center">Duração</th>
                            <th class="py-3 px-6 text-center">Estado</th>
                            <th class="py-3 px-6 text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">1011</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">071 99999-9999</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="font-medium">1 minuto e 17 segundos</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Ativa</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">1012</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">1015</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">

                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Em transferência</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">

                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">71 99999-9998</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">1020</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="font-medium">25 segundos </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Tocando</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script>
        // Answered
        var answered = document.getElementById('answered');
        var myChart = new Chart(answered, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
                datasets: [{
                    label: 'Atendidas',
                    data: [98, 154, 45, 79, 100, 168],
                    backgroundColor: 'rgba(60, 165, 233, 0.5)',
                    borderColor: 'rgba(60, 165, 233, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    }
                }
            },
        });

        // No answer
        var no_answer = document.getElementById('no_answer');
        var myChart = new Chart(no_answer, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Maio', 'Junho'],
                datasets: [{
                    label: 'Perdidas',
                    data: [4, 5, 2, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    }
                }
            },
        });

        // Today calls
        var doughnut = document.getElementById('doughnut');
        var myChart = new Chart(doughnut, {
            type: 'doughnut',
            data: {
                labels: ['Atendidas', 'Perdidas', 'Ocupadas'],
                datasets: [{
                    data: [45, 10, 2],
                    backgroundColor: [
                        'rgba(60, 165, 233, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(148, 77, 184, 0.7)'
                    ],
                    borderColor: [
                        'rgba(60, 165, 233, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(148, 77, 184, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
                }
            },
        });

        var openmodal = document.querySelectorAll('.modal-open')
            for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };

        function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }

    </script>
@endsection
