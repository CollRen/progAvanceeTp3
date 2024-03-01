{{ include('layouts/header.php', { title: 'Create'})}}
    <div class="container">
        <h2>Ingredient Create</h2>
        <form method="post">
            <label>Nom
                <input type="text" name="nom" value="{{ ingredient.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}


            <select name="ingredient_categorie_id" id="">

{% for ingredientCat in ingredientcats %}

    <option value="{{ ingredientCat.id }}">{{ ingredientCat.nom }}</option>

{% endfor %}
</select>
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}