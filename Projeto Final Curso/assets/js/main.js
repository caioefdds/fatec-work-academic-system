async function changeTypeData()
{
    let option = document.getElementById('type').value;

    let name = document.getElementById('name');
    let description = document.getElementById('description');
    let titration = document.getElementById('titration');
    let period = document.getElementById('period');
    let workload = document.getElementById('workload');
    let course_id = document.getElementById('course_id');
    let class_id = document.getElementById('class_id');

    name.classList.add('d-none');
    description.classList.add('d-none');
    titration.classList.add('d-none');
    period.classList.add('d-none');
    workload.classList.add('d-none');
    course_id.classList.add('d-none');
    class_id.classList.add('d-none');

    option = parseInt(option);
    switch (option) {
        case 1: {
            name.classList.remove('d-none');
            period.classList.remove('d-none');
            description.classList.remove('d-none');
            break;
        }
        case 2: {
            name.classList.remove('d-none');
            workload.classList.remove('d-none');
            course_id.classList.remove('d-none');
            break;
        }
        case 3: {
            name.classList.remove('d-none');
            titration.classList.remove('d-none');
            break;
        }
        case 4: {
            description.classList.remove('d-none');
            course_id.classList.remove('d-none');
            break;
        }
        case 5: {
            name.classList.remove('d-none');
            class_id.classList.remove('d-none');
            break;
        }
    }
}

function deleteRegister(type, id)
{
    let confirmation = confirm("Você tem certeza? Cadastros relacionados serão excluídos!");

    if (confirmation == true) {
        $.ajax({
            url: "class/Ajax.php?func=delete",
            type: "POST",
            data: {
                type: type,
                id: id
            }
        }).done((result) => {
            let data = JSON.parse(result);
            if (data.status == 200) {
                alert(data.msg);
                document.location.reload(true);
            } else {
                alert("erro ao excluir registro!");
            }

        });
    }
}

function editRegister(type, id)
{
    let c_type = convertType(type);
    $("#edit_id").val(id);
    $("#edit_type").val(c_type);
    $("#editForm").submit();
}

function convertType(type)
{
    switch (type) {
        case 1: {
            return 1;
        }
        case 2: {
            return 3;
        }
        case 3: {
            return 2;
        }
        case 4: {
            return 4;
        }
        case 5: {
            return 5;
        }
    }
}

function getInfo(type, id)
{
    $.ajax({
        url: "class/Ajax.php?func=getInfo",
        type: "POST",
        data: {
            type: type,
            id: id
        }
    }).done((result) => {
        let data = JSON.parse(result);

        console.log(data[0])

        $('input[name=name]').val(data[0].name);
        $('input[name=description]').val(data[0].description);
        $('select[name=titration]').val(data[0].titration);
        $('input[name=period]').val(data[0].period);
        $('input[name=workload]').val(data[0].workload);
        $('select[name=course_id]').val(data[0].course_id);
        $('select[name=class_id]').val(data[0].class_id);
    });
}

function confirmEdit(id)
{
    event.preventDefault();
    $.ajax({
        url: "class/Ajax.php?func=update",
        type: "POST",
        data: {
            type: $('#type').val(),
            id: id,
            data: {
                name: $('input[name=name]').val(),
                description: $('input[name=description]').val(),
                titration: $('select[name=titration]').val(),
                period: $('input[name=period]').val(),
                workload: $('input[name=workload]').val(),
                course_id: $('select[name=course_id]').val(),
                class_id: $('select[name=class_id]').val()
            }
        }
    }).done((result) => {
        let data = JSON.parse(result);
        if (data.status == 200) {
            alert(data.msg);
            window.location.href = "index.php?page=reports";
        }
    });
}