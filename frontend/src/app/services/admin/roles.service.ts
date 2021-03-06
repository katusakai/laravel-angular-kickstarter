import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class RolesService {

  constructor(
    private _http: HttpClient,
  ) { }

  index () {
    return this._http.get(`${environment.backendUri}/admin/role`);
  }

  update (roleId: number, userId: number) {
    return this._http.put(`${environment.backendUri}/admin/role/${roleId}/${userId}`, '');
  }
}
