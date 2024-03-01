{{ include('layouts/header.php', { title: 'Create'})}}
    <div class="container">
        <h2>IngredientCat Create</h2>
        <form method="post">
            <label>Nom
                <input type="text" name="nom" value="{{ ingredientCat.nom }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}