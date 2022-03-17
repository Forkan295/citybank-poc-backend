@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="py-4">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Create Oauth Client</h1>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('client.index') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Back</a>
                </div>
            </div>

            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        @if(session()->has('success'))
                            <div class="font-medium text-green-600">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <form action="{{ route('client.store') }}" method="POST">
                            @csrf

                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                          <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                          @if ($errors->has('name'))
                                            <span class="text-sm text-red-600">{{ $errors->first('name') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3" id="redirect_col">
                                            <label for="redirect" class="block text-sm font-medium text-gray-700">Redirect Link</label>
                                            <input type="url" name="redirect" id="redirect" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @if ($errors->has('redirect'))
                                            <span class="text-sm text-red-600">{{ $errors->first('redirect') }}</span>
                                          @endif
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" value="pkce" type="radio" name="client_type" id="pkce">
                                                <label class="form-check-label inline-block text-gray-800" for="pkce">
                                                    PKCE Oauth Client
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" value="password" type="radio" name="client_type" id="password">
                                                <label class="form-check-label inline-block text-gray-800" for="password">
                                                    Password Oauth Client
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                  <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
       // if select pasword radio button hide the redirect field
       $('#password').click(function(){
           $('#redirect_col').hide();
       });
       $('#pkce').click(function(){
           $('#redirect_col').show();
       });

    </script>
@endpush
