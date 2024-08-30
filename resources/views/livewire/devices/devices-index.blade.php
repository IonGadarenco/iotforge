<div class="mt-8 flow-root">
    <table style="width: 100%" class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm front-semibold text-gray-900 sm:pl-6 lg:pl-8">ID</th>
                <th scope="col" class=" px-3 py-3.5 pl-4 pr-3 text-left text-sm front-semibold text-gray-900 sm:pl-6 lg:pl-8">User</th>
                <th scope="col" class=" px-3 py-3.5 pl-4 pr-3 text-left text-sm front-semibold text-gray-900 sm:pl-6 lg:pl-8">Device Type</th>
                <th scope="col" class=" px-3 py-3.5 pl-4 pr-3 text-left text-sm front-semibold text-gray-900 sm:pl-6 lg:pl-8">Device Identifire</th>
                <th scope="col" class=" px-3 py-3.5 pl-4 pr-3 text-left text-sm front-semibold text-gray-900 sm:pl-6 lg:pl-8">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($devices as $device)
            <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-center">{{$device->id}}</td>
                <td class="text-center">{{$device->user->name}}</td>
                <td class="text-center">{{$device->device_type}}</td>
                <td class="text-center">{{$device->device_identifier}}</td>
                <td class="text-center">
                    <a href="{{route("device.show", $device->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-5">View</a>
                    <a href="{{route("device.edit", $device->id)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
