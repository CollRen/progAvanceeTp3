{{ include('layouts/header.php', { title: 'Show'})}}
    <div class="container">
        <h2>Umesure Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ umesure.nom }}</p>

        <a href="{{base}}/umesure/edit?id={{umesure.id}}" class="btn block">Edit</a>
        <form action="{{base}}/umesure/delete" method="post">
            <input type="hidden" name="id" value="{{ umesure.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}