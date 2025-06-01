<div {{ $attributes->merge(['class' => 'rounded-2xl p-8 bg-gradient-to-br from-white to-slate-100 shadow-2xl']) }}>
        <form class="mt-8 space-y-6" {{$attributes}}>
            @csrf
            {{$slot}}
        </form>
</div>