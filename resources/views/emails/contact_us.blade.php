<h3>Sender: {{ $sender }}</h3>
<p>
	Name: {{ $name }} , <br>
	Contact {{ $contact }}
</p>

<p>
	Country: {{ $country }}, <br>City: {{ $city }}
</p>

<h3>Message</h3>

<p>{{ nl2br( $msg ) }}</p>