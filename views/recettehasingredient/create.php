{{ include('layouts/header.php', { title: 'Create RHI'})}}

<div class="container">
    <h2>Ajouter maintenant vos ingrédients</h2>
    <p>recette numéro {{ recette_id }}</p>


    <form method="post">

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
                        <label for="quantite">Quantité: </label>
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
        <input type="hidden" name="recette_id" value="{{ recette_id }}">
        <input type="submit" class="btn" value="Save">
    </form>
</div>

<div class="container">

    <ul>
        <li>{{ recette_id }}</li>
    </ul>


    {% if recettehasingredients is defined %}
    <table>
        <thead>
            <tr>
                <td>Quantité</td>
                <td>Unité de mesure</td>
                <td>Ingrédient</td>
            </tr>
        </thead>
        <tbody>

            {% for recettehasingredient in recettehasingredients %}
                {% if recettehasingredient.recette_id == recette_id %}
                    <tr>

                        <td>{{ recettehasingredient.quantite }}</td>
                        {% for umesure in umesures %}
                            {% if umesure.id == recettehasingredient.unite_mesure_id %}
                                <td>{{ umesure.nom }}</td>
                            {% endif %}
                        {% endfor %}

                        {% for ingredient in ingredients %}
                            {% if ingredient.id == recettehasingredient.ingredient_id %}
                                <td>{{ ingredient.nom }}</td>
                            {% endif %}
                        {% endfor %}
                    </tr>
                {% endif %}
            {% endfor %}
        </tbody>

    </table>
    {% endif %}


    <!--     {% if recettehasingredients is defined %}
    <ul>

        {% for recettehasingredient in recettehasingredients %}

            {% if recettehasingredient.recette_id == recette_id %}
                <li>{{ recettehasingredient }}</li>
            {% endif %}
        {% endfor %}
    </ul>

    {% endif %} -->

</div>

{{ include('layouts/footer.php') }}