class SeriesController {

    constructor(){}


    toggleInput(serieId) {
  
        let nomeSerieEl = document.querySelector('#nome-serie-'+serieId);
        let inputSerieEl = document.querySelector('#input-nome-serie-'+serieId);

        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }

    editarSerie(serieId){

        let nomeSerie = document.querySelector('#input-nome-serie-'+serieId+' > input').value;
        let token = document.querySelector('input[name="_token"').value;

        let formData = new FormData();
        formData.append('nome', nomeSerie);
        formData.append('_token', token);

        const url = `/series/editar/${serieId}`;

        //Faz a requisição
        fetch(url, {

            method: 'POST',
            body: formData
        }).then( () =>{

            this.toggleInput(serieId);
            document.querySelector(`#nome-serie-${serieId}`).textContent = nomeSerie;
        });
    }
    
}