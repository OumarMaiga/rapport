const { routes, routeReplace } = getRouteManager();
console.log(routeReplace(routes["home"], {"id": 99}))