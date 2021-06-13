<form method="POST" action="index.php?page=list">
    <div>
        <div class="text-center light-dark">
            <h2 class="uppercase">Relatórios</h2>
            <hr>
        </div>

        <div class="info-form">
            <label for="">Selecione o tipo de relatório</label><br>
            <select class="input_control" name="type" id="type">
                <option value="0" disabled selected>Selecione</option>
                <option value="1">Lista de cursos</option>
                <option value="2">Lista de professores</option>
                <option value="3">Disciplinas por curso</option>
                <option value="4">Turmas por curso</option>
                <option value="5">Alunos por turma</option>
            </select><br>

            <div class="text-center">
                <button type="submit" class="btn-submit">Gerar</button>
            </div>
        </div>
    </div>
</form>
