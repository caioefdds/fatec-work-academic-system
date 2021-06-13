<?php
    if (!empty($_POST)) :
?>
<form method="POST">
    <div>
        <div class="text-center light-dark">
            <h2 class="uppercase">Preencha corretamente</h2>
            <hr>
        </div>

        <div class="info-form">
            <label for="">Selecione o tipo de inclusão</label><br>
            <select class="input_control" name="type" id="type" onchange="changeTypeData()" readonly="readonly" disabled>
                <option value="0" disabled selected>Selecione</option>
                <option value="1">Cursos</option>
                <option value="2">Disciplinas</option>
                <option value="3">Professores</option>
                <option value="4">Turmas</option>
                <option value="5">Alunos</option>
            </select><br>

            <div id="name">
                <label for="name">Nome:</label><br>
                <input class="input_control" type="text" name="name"><br>
            </div>

            <div id="description">
                <label for="description">Descrição:</label><br>
                <input class="input_control" type="text" name="description"><br>
            </div>

            <div id="period">
                <label for="period">Período:</label><br>
                <input class="input_control" type="text" name="period"><br>
            </div>

            <div id="titration">
                <label for="titration">Titulação:</label><br>
                <select class="input_control" name="titration">
                    <option value="0" disabled selected>Selecione</option>
                    <?php
                    foreach($__controller->getTitration() as $result) {
                        echo "<option value=\"{$result['id']}\">{$result['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="workload">
                <label for="workload">Carga Horária (em horas):</label><br>
                <input class="input_control" type="number" name="workload"><br>
            </div>

            <div id="course_id">
                <label for="course_id">Ementa:</label><br>
                <select class="input_control" name="course_id">
                    <option value="0" disabled selected>Selecione</option>
                    <?php
                    foreach($__controller->getCourses() as $result) {
                        echo "<option value=\"{$result['id']}\">{$result['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="class_id">
                <label for="class_id">Turma:</label><br>
                <select class="input_control" name="class_id">
                    <option value="0" disabled selected>Selecione</option>
                    <?php
                    foreach($__controller->getClasses() as $result) {
                        echo "<option value=\"{$result['id']}\">{$result['description']}</option>";
                    }
                    ?>
                </select>
            </div>

            <hr>

            <div class="text-center">
                <button class="btn-submit" onclick="confirmEdit(<?= $_POST['id'] ?>)">Pronto</button>
            </div>
        </div>
    </div>
</form>
<script>
    document.getElementById('type').value = <?= $_POST['type'] ?>;
    window.onload = function() {
        changeTypeData();
        getInfo(<?= $_POST['type'] ?>, <?= $_POST['id'] ?>);
    };
</script>
<?php endif ?>