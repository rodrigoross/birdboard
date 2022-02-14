<x-card style="height: 250px;">
    <h3
        class="-ml-3 font-normal text-xl py-4 pl-5 my-4 border-solid border-l-4 border-l-sky-500 hover:text-sky-500 transition ease-in-out">
        {{ $title }}
    </h3>

    <div class="text-gray-500 mb-2">
        {{ $description }}
    </div>

    <footer>
        {{ $footer }}
    </footer>
</x-card>
