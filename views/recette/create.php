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

        <table>
    <thead>
        <tr>
            <td>Quantité</td>
            <td>Unité de mesure</td>
            <td>Ingrédient</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" min="0.25" max="100" value="0.25" step="0.25" />
            </td>

            <td>
                <select name="unite_mesure_id">
                    {% for umesure in umesures %}
                    <option value="{{ umesure.id }}">{{ umesure.nom }}</option>
                    {% endfor %}
                </select>
            </td>

            <td>
                <select name="ingredient_id">
                    {% for ingredient in ingredients %}
                    <option value="{{ ingredient.id }}">{{ ingredient.nom }}</option>
                    {% endfor %}
                </select>
            </td>
        </tr>
    </tbody>

</table>

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


<table>
    <thead>
        <tr>
            <td>Quantité</td>
            <td>Unité de mesure</td>
            <td>Ingrédient</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" min="0.25" max="100" value="0.25" step="0.25" />
            </td>

            <td>
                <select name="unite_mesure_id">
                    {% for umesure in umesures %}
                    <option value="{{ umesure.id }}">{{ umesure.nom }}</option>
                    {% endfor %}
                </select>
            </td>

            <td>
                <select name="ingredient_id">
                    {% for ingredient in ingredients %}
                    <option value="{{ ingredient.id }}">{{ ingredient.nom }}</option>
                    {% endfor %}
                </select>
            </td>
        </tr>
    </tbody>

</table>