{{ include('layouts/header.php', { title: 'Create'})}}
<div class="container">
    <h2>Recette Create</h2>
    <form method="post">
    <label {% if errors.titre is defined %}class="error" {% endif %}>Titre
            <input type="text" name="titre" value="{{ recette.titre }}">
        </label>
        <label>Description
            <input type="text" name="description" value="{{ recette.description }}">
        </label>

        <label>Temps de préparation <small>(En minutes)</small>
            <input type="text" name="temps_preparation" value="{{ recette.temps_preparation }}">
        </label>

        <label>temps_cuisson <small>(En minutes)</small>
            <input type="text" name="temps_cuisson" value="{{ recette.temps_cuisson }}">
        </label>

        <label for="recette_categorie_id"></label>Catégorie
        <select name="recette_categorie_id" id="">

            {% for recetteCategorie in recetteCategories %}

            <option value="{{ recetteCategorie.id }}">{{ recetteCategorie.nom }}</option>

            {% endfor %}
        </select>

        <label for="auteur_id"></label>Auteur
        <select name="auteur_id" id="">

        
            {% for recetteAuteur in recetteAuteurs %}

            <option value="{{ recetteAuteur.id }}">{{ recetteAuteur.nom }}</option>

            {% endfor %}
        </select>

        {% if errors is defined %}
        <div class="error">
            <ul>
            {% for error in errors %}
                <li>{{ error }}</li>
            {% endfor %}
            </ul>
        </div>
        {% endif %}
        <input type="submit" class="btn" value="Save">
    </form>
</div>

{{ include('layouts/footer.php') }}