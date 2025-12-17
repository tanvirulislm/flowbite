@props([
    // array of ['label' => 'Home', 'url' => route('dashboard')]
    // last item can have url = null
    'items' => []
])

<nav class="flex p-3 bg-neutral-secondary-medium border border-default-medium rounded-base"
     aria-label="Breadcrumb">

    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

        @foreach($items as $index => $item)
            <li class="inline-flex items-center">

                @if($index > 0)
                    <svg class="w-3.5 h-3.5 mx-1.5 text-body rtl:rotate-180"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="m9 5 7 7-7 7"/>
                    </svg>
                @endif

                @if(!empty($item['url']))
                    <a href="{{ $item['url'] }}"
                       class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                        @if($index === 0)
                            <svg class="w-4 h-4 me-1.5"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                            </svg>
                        @endif

                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="inline-flex items-center text-sm font-medium text-body-subtle">
                        {{ $item['label'] }}
                    </span>
                @endif

            </li>
        @endforeach

    </ol>
</nav>
