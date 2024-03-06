{{ include('layouts/header.php', { title: 'Show'})}}
<div class="recette">
    <h1 class="recette__titre">{{ recette.titre }}</h1>
    <div class="recette__durees">
        <p><strong>Temps de préparation:</strong> {{ recette.temps_preparation }}</p>
        <p><strong>Temps de cuisson:</strong> {{ recette.temps_cuisson }}</p>
    </div>
    <div class="recette__description">
        <p>{{ recette.description }}</p>
    </div>

    <div class="liste_ingredient--container">
        {% if recettehasingredients is defined %}{% for recettehasingredient in recettehasingredients %}

            
                {% for ingredient in ingredients %}{% if ingredient.id == recettehasingredient.ingredient_id and recette.id == recettehasingredient.recette_id %}     
                    
                        
                            
                            {{recettehasingredient.recette_id}}
                                <ul class="liste_ingredient">
                                    <div class="btn-delete_rhi">
                                        <li><a href="{{ base }}/recettehasingredient/edit?recette_id={{recettehasingredient.recette_id}}&ingredient_id={{ recettehasingredient.ingredient_id }}"><span class="liste_ingredient__qte"></span>{{ recettehasingredient.quantite }}&nbsp;<span class="liste_ingredient__umesure"></span>{% for umesure in umesures %}{% if umesure.id == recettehasingredient.unite_mesure_id %}{{ umesure.nom }}{% endif %}{% endfor %}&nbsp;<span class="liste_ingredient__ingredient">{{ ingredient.nom }}&nbsp;</span></a></li>
<!--                                         <form action="{{base}}/recettehasingredient/delete" method="post">
                                            <input type="hidden" name="recette_id" value="{{ recette.id }}">
                                            <button class="btn block red">Delete</button>
                                        </form> -->
                                    </div>
                                </ul>
                            
                        
                    
                {% endif %}{% endfor %}
            

        {% endfor %}{% endif %}
    </div>

</div>
<div class="recette__infos">
    <p><strong>Auteur:</strong> {{ auteur.nom }}</p>
    <p><strong>Catégorie:</strong> {{ recetteCat.nom }}</p>
</div>
<div class="recette_btn">
    <a href="{{base}}/recette/edit?id={{recette.id}}" class="btn block">Edit</a>
    <form action="{{base}}/recette/delete" method="post">
        <input type="hidden" name="id" value="{{ recette.id }}">
        <button class="btn block red">Delete</button>
    </form>
</div>

{{ include('layouts/footer.php') }}

{{ recette.titre }}
{{ recetteCat.nom }}
{{ auteur.nom }}
<!-- {{if}}
{{for}} -->

<!-- 
    Affichage des noms des ingrédients
    Je veux

    Quantité, uMesure, nom
 -->






recettehasingredients
umesures
ingredients