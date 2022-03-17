@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="py-4">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Create Bank Client</h1>
                </div>
                
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('user.index') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Back</a>
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

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                          <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}">

                                          @if ($errors->has('name'))
                                            <span class="text-sm text-red-600">{{ $errors->first('name') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="text" name="email" id="email"  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                            <span class="text-sm text-red-600">{{ $errors->first('email') }}</span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                            <input type="text" name="phone" id="phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                            <span class="text-sm text-red-600">{{ $errors->first('phone') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                          <select id="role" name="role" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $key => $role)
                                                    <option value="{{ $key }}" @if(old('role') == $key)selected @endif>{{ $role }}</option>
                                                @endforeach
                                          </select>
                                          @if ($errors->has('role'))
                                            <span class="text-sm text-red-600">{{ $errors->first('role') }}</span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="col-span-6">
                                      <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                      <div class="mt-1">
                                        <textarea id="address" name="address" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('address') }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-sm text-red-600">{{ $errors->first('address') }}</span>
                                        @endif
                                      </div>
                                    </div>

                                    
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="account_type" class="block text-sm font-medium text-gray-700">Account Type</label>
                                          <select id="account_type" name="account_type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="">Select Account Type</option>
                                                @foreach ($accountTypes as $item)
                                                    <option value="{{ $item->id }}" {{ old('account_type') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                          </select>
                                          @if ($errors->has('account_type'))
                                            <span class="text-sm text-red-600">{{ $errors->first('account_type') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="account_no" class="block text-sm font-medium text-gray-700">Account Number</label>
                                          <input type="number" name="account_no" id="account_no" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('account_no') }}">
                                          @if ($errors->has('account_no'))
                                            <span class="text-sm text-red-600">{{ $errors->first('account_no') }}</span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="balance" class="block text-sm font-medium text-gray-700">Balance</label>
                                          <input type="number" name="balance" id="balance" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('balance') }}">
                                          @if ($errors->has('balance'))
                                            <span class="text-sm text-red-600">{{ $errors->first('balance') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="status" class="block text-sm font-medium text-gray-700">Account Status</label>
                                          <select id="status" name="status" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Inactive</option>
                                          </select>
                                          @if ($errors->has('status'))
                                            <span class="text-sm text-red-600">{{ $errors->first('status') }}</span>
                                          @endif
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <input id="is_primary" name="is_primary" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" checked>
                                            <label for="is_primary" class="font-medium text-gray-700">Is Primary Account ?</label>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6 mt-5">
                                        <div class="col-span-6 sm:col-span-3">
                                          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                          <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          @if ($errors->has('password'))
                                            <span class="text-sm text-red-600">{{ $errors->first('password') }}</span>
                                          @endif
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @if ($errors->has('password_confirmation'))
                                            <span class="text-sm text-red-600">{{ $errors->first('password_confirmation') }}</span>
                                          @endif
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
@include('layouts.footer')
@endsection