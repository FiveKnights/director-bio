<h2>New transmission from your portfolio</h2>

<p><strong>Callsign:</strong> {{ $data['name'] }}</p>
<p><strong>Return email:</strong> {{ $data['email'] }}</p>

<p><strong>Payload:</strong></p>
<p>{!! nl2br(e($data['message'])) !!}</p>