{{ include('layouts/header.php', { title: 'Recette'})}}
<div class="container">
    <h2>Recette Edit</h2>
    <form method="post">
        <label>Titre
            <input type="text" name="titre" value="{{ recette.titre }}">
        </label>

        <label>Description
            <input type="text" name="description" value="{{ recette.description }}">
        </label>

        <label>Temps de préparation
            <input type="text" name="temps_preparation" value="{{ recette.temps_preparation }}">
        </label>

        <label>Temps de cuisson
            <input type="text" name="temps_cuisson" value="{{ recette.temps_cuisson }}">
        </label>

        <label for="auteur_id">Auteur:</label>
        <select name="auteur_id" id="auteur_id">
            {% for auteur in auteurs %}

                <option value="{{ auteur.id }}" {% if auteur.id == recette.auteur_id %} selected {% endif %}>{{ auteur.nom }}</option>

            {% endfor %}
        </select>

        <label for="recette_categorie_id">Catégorie:</label>
        <select name="recette_categorie_id" id="recette_categorie_id">
            {% for recetteCat in recetteCats %}

                <option value="{{ recetteCat.id }}" {% if recetteCat.id == recette.recette_categorie_id %} selected {% endif %}>{{ recetteCat.nom }}</option>

            {% endfor %}
        </select>

        <input type="submit" class="btn" value="Update">
    </form>
</div>

{{ include('layouts/footer.php') }}






