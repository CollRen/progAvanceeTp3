{{ include('layouts/header.php', { title: 'Ingredient'})}}
<h1>Ingredient</h1>
</select>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        {% for ingredient in ingredients %}
        <tr>
            <td><a href="{{ base }}/ingredient/show?id={{ ingredient.id }}">{{ ingredient.nom }}</a></td>
            <td>
                {% for ingredientCat in ingredientcats %}

                    {% if ingredientCat.id == ingredient.ingredient_categorie_id %} 
                        {{ ingredientCat.nom }} 
                    {% endif %} 

                {% endfor %}
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>
<a href="{{ base }}/ingredient/create" class="btn">Ingredient Create</a>

{{ include('layouts/footer.php') }}