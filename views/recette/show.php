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

        {% if recetteHis is defined %}

            
                {% for recetteHi in recetteHis %}
                    
                        
                            
                          {{recetteHi.recette_id}}
                                <ul class="liste_ingredient">
                                    <div class="btn-delete_rhi">
                                        <li><a href="{{ base }}/recettehasingredient/edit?recette_id={{recetteHi.recette_id}}&ingredient_id={{ recetteHi.ingredient_id }}"><span class="liste_ingredient__qte"></span>{{ recetteHi.quantite }}&nbsp;<span class="liste_ingredient__umesure"></span>{{ recetteHi.unite_mesure_nom }}&nbsp;<span class="liste_ingredient__ingredient">{{ recetteHi.ingredient_nom }}&nbsp;</span></a></li>
<!--                                  <form action="{{base}}/recettehasingredient/delete" method="post">
                                            <input type="hidden" name="recette_id" value="{{ recette.id }}">
                                            <button class="btn block red">Delete</button>
                                        </form> -->
                                    </div>
                                </ul> 

                            
                        
                    
                {% endfor %}
            

        {% endif %}
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
