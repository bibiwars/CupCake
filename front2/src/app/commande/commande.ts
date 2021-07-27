export class Commande {
    id: number;
    ref_cmd: string;
    date_cmd: Date;
    etat_cmd: string;
    products: any[]
    constructor() {
        this.id = 0;
        this.ref_cmd = "";
        this.date_cmd = new Date();
        this.etat_cmd = "";
        this.products = [];
    }
}