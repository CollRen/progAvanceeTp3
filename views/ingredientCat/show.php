{{ include('layouts/header.php', { title: 'Show'})}}
    <div class="container">
        <h2>IngredientCat Show</h2>
        <hr>
        <p><strong>Nom:</strong> {{ ingredientCat.nom }}</p>


        <a href="{{base}}/ingredientCat/edit?id={{ingredientCat.id}}" class="btn block">Edit</a>
        <form action="{{base}}/ingredientCat/delete" method="post">
            <input type="hidden" name="id" value="{{ ingredientCat.id }}">
            <button class="btn block red">Delete</button>
        </form>
    </div>

    {{ include('layouts/footer.php') }}