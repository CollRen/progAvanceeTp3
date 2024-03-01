{{ include('layouts/header.php', { title: 'Show'})}}
    <div class="container">
        <h2>Recette Show</h2>
        <hr>
        <p><strong>Titre:</strong> {{ recette.titre }}</p>
        <p><strong>Description:</strong> {{ recette.description }}</p>
        <p><strong>Temps de préparation:</strong> {{ recette.temps_preparation }}</p>
        <p><strong>Temps de cuisson:</strong> {{ recette.temps_cuisson }}</p>
        <p><strong>Auteur:</strong> {{ auteur.nom }}</p>
        <p><strong>Catégorie:</strong> {{ recetteCat.nom }}</p>
        <a href="{{base}}/recette/edit?id={{recette.id}}" class="btn block">Edit</a>
        <form action="{{base}}/recette/delete" method="post">
            <input type="hidden" name="id" value="{{ recette.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}