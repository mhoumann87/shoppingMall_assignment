import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';

const data = [{
    name: 'Glitter',
    url: 'glitter.png'
  },
  {
    name: 'H&M',
    url: 'hm.png'
  },
  {
    name: 'Skoringen',
    url: 'skoringen.png'
  },
  {
    name: 'Sport Master',
    url: 'sport_master.png'
  },
  {
    name: 'Cafe Vivaldi',
    url: 'vivaldi.png'
  },
]

@Component({
  selector: 'page-contact',
  templateUrl: 'contact.html'
})

export class ContactPage {
  stores : any;
  constructor(public navCtrl: NavController) {
    this.stores = data;
  }

}
