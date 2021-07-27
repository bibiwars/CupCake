export class Condidature {
    id: number;
    applicateur: string;
    patisserie: string;
    message: string;
    etat: string;
    cv: string;
    constructor() {
        this.id = 0;
        this.applicateur = "";
        this.patisserie = "";
        this.message = "";
        this.etat = "pending";
        this.cv = "";
    }
}