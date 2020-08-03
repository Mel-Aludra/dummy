function selectJob(element, jobId) {

    var chosenBloc = element.parentNode.parentNode;
    var chosenJob = element;

    var blocs = document.getElementsByClassName("roleContainer");
    var jobs = document.getElementsByClassName("jobsContainer");

    for(var i = 0; i < blocs.length; i++) {
        blocs[i].classList.remove("chosen");
    }

    for(i = 0; i < jobs.length; i++) {
        var img = jobs[i].getElementsByTagName("img");
        for(var j = 0; j < img.length; j++) {
            img[j].classList.remove("chosen");
        }
    }

    chosenBloc.classList.add("chosen");
    chosenJob.classList.add("chosen");
    document.getElementById("jobIdInput").value = jobId;
    triggerAvailableDummiesBySelectTrigger(jobId);

}

//Désactiver les jobs non dispo à la sélection d'un combat.
function triggerAvailableJobsBySelectTrigger(select) {

    //On récupère toutes les images et on leur attribue par défaut le style "non dispo".
    var imgs = document.getElementsByClassName("jobsSelection")[0].getElementsByTagName("img");
    for(var i = 0; i < imgs.length; i++) {
        imgs[i].classList.add("nonAvailable");
    }

    //On récupère les jobs du dummy avec le bon index dans availableJobsByDummy (voir controller et view).
    var jobs = availableJobsByDummy[select.value];

    if(jobs !== undefined) {
        //On boucle sur le tableau de jobs dispo.
        availableJobsByDummy[select.value].forEach(function(element) {
            var imgId = "iconJobId" + element;
            var img = document.getElementById(imgId);
            if(img !== null) {
                img.classList.remove("nonAvailable"); //si dispo, on retire le style non dispo.
            }
        });
    }

}

//Griser les dummies indispo quand on choisit un job.
function triggerAvailableDummiesBySelectTrigger(jobId) {

    //On définit le select + options des dummies.
    var select = document.getElementById("dummySelection");
    var options = select.getElementsByTagName("option");

    //On va boucler sur toutes les options.
    for(var i = 0; i < options.length; i++) {

        //Pour chaque option, si un id de dummy est associé (et s'il n'est pas désactivé par défaut), on va vérifier si l'élément existe dans le job qui nous intéresse.
        if(options[i].value !== undefined && options[i].classList.contains("nativeDisabled") !== true) {

            //On récupère le tableau des dummies. S'il n'y en a pas, on déclare un tableau vide.
            var dummiesArray = availableDummiesByJob[jobId];
            if(dummiesArray === undefined) {
                dummiesArray = [];
            }

            //On part du principe qu'il n'existe pas en settant la variable à false.
            var dummyExists = false;

            //On parcourt le tableau des dummies existants du job et si la valeur de l'option = à l'un des éléments du tableau, on set la variable d'existence a true.
            dummiesArray.forEach(function(element) {
                if(Number(element) === Number(options[i].value)) {
                    dummyExists = true;
                }
            });

            //Ensuite, on définit les disabled et le texte de l'option en fonction de la réponse.
            if(dummyExists === false) {
                options[i].disabled = "disabled";
                options[i].innerHTML = options[i].innerHTML.replace(" (not available for this job yet)", ""); //on fait ça pour éviter la duplication du texte si on passe sur deux jobs ou + qui n'ont pas le fight.
                options[i].innerHTML = options[i].innerHTML + " (not available for this job yet)";
            }
            else {
                options[i].disabled = "";
                options[i].innerHTML = options[i].innerHTML.replace(" (not available for this job yet)", "");
            }

        }

    }

}