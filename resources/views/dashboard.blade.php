@extends('layouts.app')
@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
      <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
      <!-- Replace with your content -->
    <div class="py-4">
        <div class="border-1 border-dashed border-gray-200 rounded-lg h-96">
            
        </div>
    </div>
      <!-- /End replace -->
</div>
@endsection
{{-- <x-app-layout>
    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <div class="w-1/2">
                            <div class="p-6">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <form method="POST" action="/oauth/clients">
                                        @csrf

                                        <!-- Name  -->
                                            <div>
                                                <x-label for="name" :value="__('name')"/>
                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                         :value="old('name')" placeholder="Client name" required
                                                         autofocus/>
                                            </div>

                                            <!-- url  -->
                                            <div class="py-4">
                                                <x-label for="redirect" :value="__('Redirect Link')"/>
                                                <x-input id="redirect" class="block mt-1 w-full" type="text"
                                                         name="redirect" required autofocus/>
                                            </div>
                                            <div class="py-4">
                                                <x-label for="redirect" :value="__('Password Grand')"/>
                                                <x-input id="redirect" class="block mt-1" type="checkbox"
                                                         name="password_client" value="1" required autofocus/>
                                            </div>
{{--                                            <div class="py-4">--}}
{{--                                                <x-label for="redirect" :value="__('PKCE')"/>--}}
{{--                                                <x-input id="redirect" class="block mt-1" type="checkbox"--}}
{{--                                                         name="password_client" required autofocus/>--}}
{{--                                            </div>--}}


                                            <div class="flex  justify-start">
                                                <x-button>
                                                    {{ __('Create Client') }}
                                                </x-button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden">
                                        <table
                                            class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                            <thead class="bg-gray-100 dark:bg-gray-900 py-12">
                                            <tr>
                                                <th scope="col"
                                                    class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    ID
                                                </th>
                                                <th scope="col"
                                                    class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    Secret
                                                </th>
                                                <th scope="col"
                                                    class="py-4 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                    Redirect
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                            @foreach ($clients as $client)
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $client->name }}</td>
                                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $client->id }}</td>
                                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $client->secret }}</td>
                                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $client->redirect }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</x-app-layout> --}}
