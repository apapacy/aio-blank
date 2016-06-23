import asyncio
import aiohttp
import aiocouchdb


#auth = aiocouchdb.authn.BasicAuthProvider(name='admin', password='')
loop = asyncio.get_event_loop()
test = aiocouchdb.Database('http://localhost:5984/test')
server = aiocouchdb.Server()
rest = aiocouchdb.client.Resource('http://admin:password@localhost:5984')



async def all_dbs():
    #dbs = await server.all_dbs()
    test = await server.db('test')
    #res = await test.all_docs()
    #while True:
    #    rec = await res.next()
    #    if rec is None:
    #        break
    #    print(rec['value']['rev'])
    #    print(rec)
    #    doc = await test.doc(rec['key'])
    #    #response = await doc.update({"_id":rec['key'],"www": "rest"})
    #    response = rest.request('POST', path='', data={"test++--": "rest++--"})
    #print(dbs)
    #print(test)
    #print(rec)
    #dir(rec)
    #print('++++++++++++++++')
    for x in range(1, 1000000):
        asyncio.ensure_future(rest.request('POST', path='test', data={"test++--": "rest++--"}))
        #print(response)


asyncio.ensure_future(all_dbs())
loop.run_forever()
