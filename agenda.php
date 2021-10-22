<!DOCTYPE html>
    <html>

        <head>
            <meta charset="UTF-8">
            <title>Agenda_PHP</title>
        </head>

        <body>

            <style>
            body {
                text-align: center;
                background-color: #ADD8E6;
            }

            div {
                display: inline-block;
                background-color: #DCDCDC;
                padding: 20px;
                border: 1px solid;
            }

            h1,h2 {
                text-decoration: underline;
            }

            .vuelve{
                color:red;                
                display: inline-block;
                background-color: black;
                padding: 5px;

            }

            .no {
                color: yellow;                
                display: inline-block;
                background-color: black;
                padding: 5px;
            }

            </style>
            
            <?php

                /**
             * @author Gaspar Novel Porcel
             * Curso: 2n FPGS DAW Presencial
             * Módulo: DWES
             * Práctica: DWES_C2P03_formulario agenda
             * @version: 1.0
             */

            // Comprobamos si $agenda esta creada
            if (isset($_GET['agenda'])) 
                $agenda = $_GET['agenda'];
            else
                $agenda = []; // Creamos $agenda como un array vacío  
            
            if (isset($_GET['submit'])) // Comprobamos si el cliente ha hecho submit
            {

                // Filtramos el GET según el parámetro entre ''  y lo añadimos a una variable
                $nombre = filter_input(INPUT_GET,'nombre');
                $telefono = filter_input(INPUT_GET,'telefono');

                /**
                 * Comprobamos si el input del nombre esta o no vacio ya que es un campo obligatorio
                 * Si esta vacio muestra un mensaje
                 */
                if (empty($nombre)){
                    echo "<p class='no'>No has introducido un nombre por lo que los contactos estan vacios,</p>";
                    echo "<p class='vuelve'>VUELVE A INTENTARLO!</p>";
                }
                /**
                * Comprobamos si el campo del telefono esta o no vacio
                * Si esta vacio llamamos a la funcion unset que elimina la variable
                */                
                elseif (empty($telefono)) {
                    unset($agenda[$nombre]);
                }
                else // Si no esta vacio añadimos el nuevo telefono 
                {
                    $agenda[$nombre] = $telefono;
                }

                mostrarFormulario($agenda); 

                mostrarAgenda($agenda); 

            } else { // Si el cliente no ha hecho submit simplemente mostrará el formulario

                mostrarFormulario($agenda);

            }

        /**
         * Muestra el formulario y le pasamos por parametro los contactos que esten dentro de la variable $agenda
         * Guardamos los contactos en un input de tipo "hidden"
         */

        function mostrarFormulario($agenda) {

            ?>

            <h1>Agenda_PHP</h1>

            <form name="formulario" method="get" action="">
                <div>
                    <h3>Formulario de contacto</h3>
                    <label>Nombre: </label>
                    <input type="text" name="nombre"/><br><br>
                    <label>Teléfono:</label>
                    <input type="text" maxlength="9" name="telefono"/><br><br>
                    <?php

                    // Por cada contacto creamos un input "hidden" gracias al bucle foreach
                    foreach ($agenda as $nombre => $telefono) {
                        echo '<input type="hidden" name="agenda[' . $nombre . ']" ';
                        echo 'value="' . $telefono . '"/>';
                    }
                    ?>

                    <input type="submit" name="submit" value="Añadir" />
                </div>
            </form>
            <?php
        }

        // Muestra la agenda con las modificaciones que se hayan realizado por formulario
        function mostrarAgenda($agenda) {

            $print = '<h2>Contactos</h2><div><table border="4px solid #ddd"><tr>';
            $print .= '<th style="height: 50px; width: 100px;">Nombre </th><th style="height: 30px; width: 100px;"> Teléfono </th></tr>';

            // Recorremos con el bucle la variable $agenda y guardamos los valores
            foreach ($agenda as $nombre => $telefono) {
                $print .= '<tr>';
                $print .= '<th style="font-weight: normal; height: 40px; width: 100px;">' . $nombre . '</th>';
                $print .= '<th style="font-weight: normal; height: 40px; width: 100px;">' . $telefono . '</th>';
                $print .= '</tr>';
            }
            $print .= '</table></div>';

            //Mostramos en el html todo lo inlcuido en la variable $print
            echo $print;
        }

        ?>
        </body>

    </html>