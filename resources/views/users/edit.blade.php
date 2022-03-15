<x-app-layout>
    <div class="py-4">
        <div class="max-w-7 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <div class="p-6">
                            <div class="bg-white shadow-sm sm:rounded-lg">
                            	<h2>Edit</h2>
                                <x-auth-validation-errors />

                            	@if(session()->has('success'))
								    <div class="font-medium text-green-600">
								        {{ session()->get('success') }}
								    </div>
								@endif

                                <form method="post" action="{{ route('user.update', $user) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="py-1">
                                        <x-label for="name" :value="__('Name')"/>
                                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="email" :value="__('Email')"/>
                                        <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="phone" :value="__('Phone')"/>
                                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$user->phone" required/>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="address" :value="__('Address')"/>
                                        <textarea id="address" class="block mt-1 w-full" name="address">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="py-1">
                                        <x-label for="role" :value="__('Role')"/>
                                        <select name="role" id="role" class="block mt-1 w-full" required>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $key }}" @if ($user->role == $key) selected @endif>{{ $role }}</option>
                                            @endforeach
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
                                            {{ __('Update') }}
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
