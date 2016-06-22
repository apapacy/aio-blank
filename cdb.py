import asyncio
import aiocouchdb

loop = asyncio.get_event_loop()
test = aiocouchdb.Database('http://localhost:5984/test')
server = aiocouchdb.Server()

@asyncio.coroutine
def all_dbs():
    dbs = yield from server.all_dbs()
    test = yield from server.db('test')
    docs = yield from asyncio.ensure_future(test.all_docs())
    res = yield from test.all_docs()
    while True:
        rec = yield from res.next()
        if rec is None:
            break
        print(rec)
    print(dbs)
    print(test)
    print(docs)
    dir(docs)
    print('++++++++++++++++')


asyncio.ensure_future(all_dbs())
loop.run_forever()
