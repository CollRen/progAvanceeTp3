{{ include('layouts/header.php', { title: 'Show'})}}


asjdf;ldskfgj;aslj;lksdg
    <div class="recette">
        <h1 class="recette__titre">{{ recette.titre }}</h1>
        <div class="recette__durees">
            <p><strong>Temps de préparation:</strong> {{ recette.temps_preparation }}</p>
            <p><strong>Temps de cuisson:</strong> {{ recette.temps_cuisson }}</p>
        </div>
        <div class="recette__description">
            <p>{{ recette.description }}</p>
        </div>

    </div>
    <div class="recette__infos">
        <p><strong>Auteur:</strong> {{ auteur.nom }}</p>
        <p><strong>Catégorie:</strong> {{ recetteCat.nom }}</p>
    </div>
    <div class="recette_btn">
        <a href="{{base}}/recette/edit?id={{recette.id}}" class="btn block">Edit</a>
        <form action="{{base}}/recettehasingredient/store" method="post">
            <input type="hidden" name="id" value="{{ recette.id }}">
            <button class="">Ajouter des ingrédients</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}