@extends('admin.layout')

@section('title', $def['label'])

@section('content')
<div class="space-y-6">

    <div class="border-b border-slate-300 pb-2 flex flex-wrap justify-between items-end gap-4">
        <div>
            <span class="text-xs font-tech text-[#1d6cd8] font-bold uppercase tracking-widest">// {{ $def['hint'] }}</span>
            <h2 class="text-xl font-black text-slate-800 uppercase">{{ $def['label'] }}</h2>
        </div>
        <a href="{{ route('admin.create', $resource) }}"
           class="inline-flex items-center px-5 py-2.5 bg-[#1d6cd8] text-white font-tech font-bold text-xs tracking-widest uppercase clip-button hover:opacity-90 transition-opacity">
            + NEW {{ strtoupper($def['singular']) }}
        </a>
    </div>

    @if ($errors->has('delete'))
        <div class="px-4 py-3 font-tech text-xs font-bold uppercase tracking-wider bg-[#ef4444]/10 text-[#ef4444] border border-[#ef4444]/30">
            {{ $errors->first('delete') }}
        </div>
    @endif

    <div class="bg-white/90 backdrop-blur-md border border-slate-300 shadow-sm rounded-lg overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left">
                <tr class="font-tech text-[11px] uppercase tracking-widest text-slate-500">
                    @foreach ($def['columns'] as $col)
                        <th class="p-3">{{ $fields[$col]['short'] ?? $fields[$col]['label'] }}</th>
                    @endforeach
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        @foreach ($def['columns'] as $col)
                            @php $value = $item->{$col}; @endphp
                            <td class="p-3 align-middle">
                                @if (isset($def['render'][$col]))
                                    {!! $def['render'][$col]($item) !!}
                                @elseif ($fields[$col]['type'] === 'image')
                                    @if ($value)
                                        <img src="{{ asset($value) }}" alt="" class="w-16 h-10 object-cover border border-slate-300">
                                    @endif
                                @elseif ($fields[$col]['type'] === 'checkbox')
                                    <span class="font-tech font-bold {{ $value ? 'text-[#10b981]' : 'text-slate-400' }}">{{ $value ? '✓' : '—' }}</span>
                                @elseif (is_array($value))
                                    {{ implode(', ', $value) }}
                                @else
                                    <span class="{{ $loop->first ? 'font-bold text-slate-800' : 'text-slate-600' }}">{{ $value }}</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="p-3 whitespace-nowrap text-right font-tech text-xs font-bold uppercase">
                            <a href="{{ route('admin.edit', [$resource, $item->getKey()]) }}" class="text-[#1d6cd8] hover:underline">EDIT</a>
                            <form method="POST" action="{{ route('admin.destroy', [$resource, $item->getKey()]) }}" class="inline"
                                  onsubmit="return confirm('Delete this entry?')">
                                @csrf
                                @method('DELETE')
                                <button class="ml-3 text-[#ef4444] hover:underline uppercase">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($def['columns']) + 1 }}" class="p-8 text-center font-tech text-xs uppercase tracking-widest text-slate-400">
                            NO RECORDS
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection