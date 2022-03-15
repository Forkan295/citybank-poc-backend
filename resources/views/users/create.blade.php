<x-app-layout>
    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <div class="p-6">
                            <div class="bg-white shadow-sm sm:rounded-lg">
                            	<h2>Create User</h2>
                                <x-auth-validation-errors />

                            	@if(session()->has('success'))
								    <div class="font-medium text-green-600">
								        {{ session()->get('success') }}
								    </div>
								@endif

                                <form method="post" action="{{ route('user.store') }}">
                                    @csrf

                                    <div class="py-1">
                                        <x-label for="name" :value="__('Name')"/>
                                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="email" :value="__('Email')"/>
                                        <x-input id="email" class="block mt-1 w-full" type="text" name="email" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="phone" :value="__('Phone')"/>
                                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="address" :value="__('Address')"/>
                                        <textarea id="address" class="block mt-1 w-full"  name="address"></textarea>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="role" :value="__('Role')"/>
                                        <select name="role" id="role" class="block mt-1 w-full" required>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $key }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="account_type" :value="__('Account Type')"/>
                                        <select name="account_type" id="role" class="block mt-1 w-full" required>
                                            <option value="">Select Account Type</option>
                                            @foreach ($accountTypes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="account_no" :value="__('Account Number')"/>
                                        <x-input id="account_no" class="block mt-1 w-full" type="number" name="account_no" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="balance" :value="__('Account Balance')"/>
                                        <x-input id="balance" class="block mt-1 w-full" type="number" name="balance"/>
                                    </div>
                                    <div class="py-1">
                                        <input type="checkbox" name="is_primary" checked value="1"> Is Primary Account ?
                                    </div>
                                    <div class="py-1">
                                        <x-label for="status" :value="__('Account Status')"/>
                                        <select name="status" id="status" class="block mt-1 w-full" required>
                                            <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="py-1">
                                        <x-label for="password" :value="__('Password')"/>
                                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
                                    </div>
                                    <div class="py-2">
                                        <x-label for="cpassword" :value="__('Confirm Password')"/>
                                        <x-input id="cpassword" class="block mt-1 w-full" type="password" name="password_confirmation" required/>
                                    </div>

                                    <div class="flex  justify-start">
                                        <x-button>
                                            {{ __('Save') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
