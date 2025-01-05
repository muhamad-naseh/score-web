<div>
    <div wire:poll>
        @foreach($this->scores as $score)
            <li>{{$score['score_type']}}-{{$score['score_value']}}</li>
        @endforeach
    </div>
</div>
