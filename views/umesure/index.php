{{ include('layouts/header.php', { title: 'Umesure'})}}
    <h1>Umesure</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        {% for umesure in umesures %}
            <tr>
                <td><a href="{{ base }}/umesure/show?id={{ umesure.id }}">{{ umesure.nom }}</a></td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{ base }}/umesure/create" class="btn" >Umesure Create</a>

    {{ include('layouts/footer.php') }}