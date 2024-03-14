{{ include('layouts/header.php', { title: 'Edit RHI'})}}

<div class="container">
    <h2>Ajuster cet ingrédient</h2>
    <p>Recette numéro: {{ recettehasingredients.recette_id }}</p>


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
                        <input type="number" name="quantite" min="0.25" max="100" value="{{ recettehasingredients.quantite }}" step="0.25" />
                    </td>

                    <td>
                        <select name="unite_mesure_id">
                            {% for umesure in umesures %}
                            
                            <option value="{{ umesure.id }}"{% if umesure.id == recettehasingredients.unite_mesure_id %} selected {% endif %}>{{ umesure.nom }}</option>
                            
                            {% endfor %}
                        </select>
                    </td>

                    <td>
                        <select name="ingredient_id">
                            {% for ingredient in ingredients %}
                            <option value="{{ ingredient.id }}"{% if ingredient.id == recettehasingredients.ingredient_id %} selected {% endif %}>{{ ingredient.nom }}</option>
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