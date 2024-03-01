{{ include('layouts/header.php', { title: 'Ingredient'})}}
<div class="container">
    <h2>Ingredient Edit</h2>
    <form method="post">
        <label>Nom
            <input type="text" name="nom" value="{{ ingredient.nom }}">
        </label>
        {% if errors.name is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}

        <select name="ingredient_categorie_id" id="">

            {% for ingredientCat in ingredientcats %}

            <option value="{{ ingredientCat.id }}" {% if ingredientCat.id == ingredient.ingredient_categorie_id %} selected {% endif %}>{{ ingredientCat.nom }}</option>

            {% endfor %}
        </select>

        <input type="submit" class="btn" value="Update">
    </form>
</div>
{{ include('layouts/footer.php') }}