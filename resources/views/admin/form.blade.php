@extends('admin.layout')

@section('title')
{{ $item->exists ? 'Edit' : 'New' }} {{ $def['singular'] }}
@endsection

@section('content')
@php
    $editing = $item->exists;
    $spans   = [1 => 'md:col-span-1', 2 => 'md:col-span-2', 3 => 'md:col-span-3'];
    $input   = 'w-full font-tech text-sm border border-slate-300 bg-white px-3 py-2 focus:outline-none focus:border-[#1d6cd8] disabled:bg-slate-100 disabled:text-slate-500';
    $label   = 'block font-tech text-[11px] font-bold uppercase tracking-widest text-slate-500 mb-1';
@endphp

<div class="space-y-6">

    <div class="border-b border-slate-300 pb-2">
        <span class="text-xs font-tech text-[#1d6cd8] font-bold uppercase tracking-widest">// {{ $def['label'] }}</span>
        <h2 class="text-xl font-black text-slate-800 uppercase">{{ $editing ? 'EDIT' : 'NEW' }} {{ strtoupper($def['singular']) }}</h2>
    </div>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $editing ? route('admin.update', [$resource, $item->getKey()]) : route('admin.store', $resource) }}"
          class="bg-white/90 backdrop-blur-md border-2 border-[#1d6cd8] p-5 md:p-6 shadow-md clip-corner-tr grid md:grid-cols-3 gap-4">
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        @foreach ($fields as $f)
            @php
                $name   = $f['name'];
                $locked = $editing && ! empty($f['immutable']);
                $old    = old($name);
                $value  = $old !== null ? $old : \App\Admin\FieldCodec::forForm($f['type'], $item->{$name});
                $checked = old() ? (bool) old($name) : (bool) $item->{$name};
                $selected = (string) $value;
            @endphp

            <div class="{{ $spans[$f['span'] ?? 3] }}">

                @if ($f['type'] === 'checkbox')
                    <label class="flex items-center gap-2 font-tech text-xs font-bold uppercase text-slate-600 md:pt-6">
                        <input type="checkbox" name="{{ $name }}" value="1" @checked($checked) class="w-4 h-4 accent-[#1d6cd8]">
                        {{ $f['label'] }}
                    </label>
                @else
                    <label for="f-{{ $name }}" class="{{ $label }}">{{ $f['label'] }}</label>

                    @switch($f['type'])
                        @case('textarea')
                        @case('lines')
                            <textarea id="f-{{ $name }}" name="{{ $name }}" rows="{{ $f['rows'] ?? 4 }}"
                                      class="{{ $input }}">{{ $value }}</textarea>
                            @break

                        @case('select')
                            <select id="f-{{ $name }}" name="{{ $name }}" class="{{ $input }}">
                                @foreach ($f['choices'] as $optionValue => $optionLabel)
                                    <option value="{{ $optionValue }}" @selected($selected === (string) $optionValue)>{{ $optionLabel }}</option>
                                @endforeach
                            </select>
                            @break

                        @case('image')
                            @if ($editing && $item->{$name})
                                <div class="flex items-center gap-3 mb-2">
                                    <img src="{{ asset($item->{$name}) }}" alt="" class="w-28 h-16 object-cover border border-slate-300">
                                    <label class="flex items-center gap-2 font-tech text-xs font-bold uppercase text-slate-600">
                                        <input type="checkbox" name="remove_{{ $name }}" value="1" class="w-4 h-4 accent-[#1d6cd8]"> REMOVE CURRENT IMAGE
                                    </label>
                                </div>
                            @endif
                            <input id="f-{{ $name }}" type="file" name="{{ $name }}" accept="image/*" class="font-tech text-xs">
                            @break

                        @case('number')
                            <input id="f-{{ $name }}" type="number" name="{{ $name }}" value="{{ $value }}"
                                   min="{{ $f['min'] ?? 0 }}" max="{{ $f['max'] ?? 9999 }}" class="{{ $input }}">
                            @break

                        @default
                            <input id="f-{{ $name }}" type="text" name="{{ $locked ? '' : $name }}" value="{{ $value }}"
                                   placeholder="{{ $f['placeholder'] ?? '' }}" @disabled($locked) class="{{ $input }}">
                    @endswitch
                @endif

                @if (! empty($f['help']))
                    <p class="mt-1 font-tech text-[11px] text-slate-400">{{ $f['help'] }}</p>
                @endif
                @error($name)<p class="mt-1 font-tech text-[11px] text-[#ef4444]">{{ $message }}</p>@enderror
            </div>
        @endforeach

        <div class="md:col-span-3 flex items-center gap-4 pt-2">
            <button class="px-6 py-2.5 bg-[#1d6cd8] text-white font-tech font-bold text-xs tracking-widest uppercase clip-button hover:opacity-90 transition-opacity">
                SAVE
            </button>
            <a href="{{ route('admin.index', $resource) }}" class="font-tech text-xs font-bold uppercase text-slate-500 hover:text-slate-800">CANCEL</a>
        </div>
    </form>
</div>
@endsection