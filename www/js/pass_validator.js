let inpt = document.querySelector('#old_key');

let requirements = [
    {
        "re": /^.*\d.*$/,
        "msg": "La contraseña deberá tener al menos un número.",
        "acmpl": false,
        "nd": null,
    },
    {
        "re": /.{6,}/,
        "msg": "Incluir al menos 6 caracteres.",
        "acmpl": false,
        "nd": null,
    },
    {
        "re": /^.*[A-Z].*$/,
        "msg": "La contraseña deberá tener al menos una letra mayúscula.",
        "acmpl": false,
        "nd": null,
    },
    {
        "re": /^.*[a-z].*$/,
        "msg": "La contraseña deberá tener al menos una letra minúscula.",
        "acmpl": false,
        "nd": null,
    },
    // {
    //     "re": /^.*[a-z].*$/,
    //     "msg": "La contraseña deberá tener al menos una letra minúscula.",
    //     "acmpl": false,
    // },
];

{/* <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?=$login_msg?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> */}

let alert_template = document.createElement('div');
alert_template.role = 'alert';
alert_template.classList.add('alert', 'alert-warning');
alert_template.style.display = 'None';


let lint_container = document.querySelector('#pass_linter_container');

for (let i = 0; i < requirements.length; i++) {
    requirements[i].nd = alert_template.cloneNode();
    requirements[i].nd.textContent = requirements[i].msg;
    lint_container.appendChild(requirements[i].nd);
}

inpt.addEventListener('input', (e)=>{
    let current_pass = inpt.value;
    for (let i = 0; i < requirements.length; i++) {
        const element = requirements[i];
        requirements[i].nd.style.display = (Boolean(element['re'].exec(current_pass)) ? 'None' : '');
    }
    // console.log(requirements[3])
});