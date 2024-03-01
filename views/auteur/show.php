{{ include('layouts/header.php', { title: 'Liste auteurs'})}}
    <div class="container">
        <h2>Auteurs</h2>
        <hr>
        <p><strong>Prénom:</strong> {{ auteur.prenom }}</p>
        <p><strong>Nom:</strong> {{ auteur.nom }}</p>

        <a href="{{base}}/auteur/edit?id={{auteur.id}}" class="btn block">Edit</a>
        <form action="{{base}}/auteur/delete" method="post">
            <input type="hidden" name="id" value="{{ auteur.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}