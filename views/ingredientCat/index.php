{{ include('layouts/header.php', { title: 'IngredientCat'})}}
    <h1>IngredientCat</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for ingredientCat in ingredientcats %}
            <tr>
                <td><a href="{{ base }}/ingredientCat/show?id={{ ingredientCat.id }}">{{ ingredientCat.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    
    <a href="{{ base }}/ingredientCat/create" class="btn" >IngredientCat Create</a>

    {{ include('layouts/footer.php') }}