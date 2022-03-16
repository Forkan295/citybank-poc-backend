@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="py-4">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Activiry Log</h1>
                </div>
            </div>

            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-white">
                                  <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Log Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User Id</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created At</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Action</th>
                                    <th scope="col" class="relative py-3.5">
                                      <span class="sr-only">Details</span>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($activityLogs as $item)
                                    <tr class="border-t border-gray-300">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $loop->index + 1 }}</td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $item->log_name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item->causer_id }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ 'success' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item->created_at }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                          <a href="{{ route('activity_log.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Details</a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>

                            @if ($activityLogs->links())
                                {{ $activityLogs->links() }}
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection