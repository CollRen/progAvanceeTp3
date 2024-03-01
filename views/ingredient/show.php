{{ include('layouts/header.php', { title: 'Show'})}}
<div class="container">
    <h2>Ingredient Show</h2>
    <hr>
    <p><strong>Nom:</strong> {{ ingredient.nom }}</p>

    {% for ingredientCat in ingredientcats %}
        {% if ingredientCat.id == ingredient.ingredient_categorie_id %}

            <p><strong>Catégorie:</strong> {{ ingredientCat.nom }} </p>

        {% endif %}
    {% endfor %}

    <a href="{{base}}/ingredient/edit?id={{ingredient.id}}" class="btn block">Edit</a>
    <form action="{{base}}/ingredient/delete" method="post">
        <input type="hidden" name="id" value="{{ ingredient.id }}">
        <button class="btn block red">Delete</button>
    </form>
</div>

{{ include('layouts/footer.php') }}