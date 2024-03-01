{{ include('layouts/header.php', { title: 'Recette'})}}
    <h1>Recette</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Temps préparation <small>(min)</small></th>
                <th>Temps de cuisson <small>(min)</small></th>
                <th>Auteur</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
        {% for recette in recettes %}
            <tr>
                <td><a href="{{ base }}/recette/show?id={{ recette.id }}&recette_categorie_id={{ recette.recette_categorie_id }}&auteur_id={{ recette.auteur_id }}">{{ recette.titre }}</a></td>
                <td>{{ recette.temps_preparation }}</td>
                <td>{{ recette.temps_cuisson }}</td>

                {% for auteur in auteurs %}
                    {% if recette.auteur_id == auteur.id %} 
                        <td>{{ auteur.nom }}</td>
                    {% endif %} 
                {% endfor %}

                {% for recetteCat in recetteCats %}
                    {% if recette.recette_categorie_id == recetteCat.id %} 
                        <td>{{ recetteCat.nom }}</td>
                    {% endif %} 
                {% endfor %}
          
        {% endfor %}

            </tr>
        </tbody>
    </table>
    <a href="{{ base }}/recette/create" class="btn" >Recette Create</a>

    {{ include('layouts/footer.php') }}
