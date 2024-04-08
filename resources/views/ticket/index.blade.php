<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
       <div class="flex justify-between w-full sm:max-w-xl">
           <h1 class="text-blue-400 text-lg fond-bold">Support Ticket</h1>
           <div class="flex">
            <a href="{{route('ticket.create')}}">Create New</a>
           </div>
        </div>
       
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
          @forelse ($tickets as $ticket)
          <div class="text-blue-800 flex justify-between py-4">
              <a href="{{route('ticket.show',$ticket->id)}}">{{$ticket->id}}</a>
              <p>{{$ticket->title}}</p>
              <p>{{$ticket->description}}</p>
          </div>
          @empty
          <p class="text-black">You don't have any tickets !!</p>
          @endforelse
            
        </div>
    </div>
</x-app-layout>
