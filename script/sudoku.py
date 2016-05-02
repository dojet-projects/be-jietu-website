#!/usr/bin/python

sd = [
    4, 8, 0,   1, 0, 0,   0, 0, 0,
    0, 0, 0,   0, 0, 7,   0, 5, 0,
    0, 0, 1,   0, 0, 0,   0, 0, 0,

    0, 0, 3,   0, 8, 5,   2, 0, 0,
    0, 0, 2,   7, 4, 0,   0, 0, 0,
    0, 4, 0,   0, 0, 9,   8, 0, 0,

    1, 0, 0,   0, 0, 0,   0, 0, 2,
    3, 0, 8,   0, 0, 0,   0, 0, 1,
    2, 5, 7,   0, 0, 0,   0, 7, 0,
]


cell = [set()] * 81

def row(y):
    return [sd[idx] for idx in range(y * 9, (y + 1) * 9)]


def col(x):
    return [sd[idx] for idx in range(x, 81, 9)]


def square(x, y):
    sx = x / 3 * 3
    sy = y / 3 * 3
    return [sd[idx] for r in range(sy, sy + 3) for idx in range(r * 9 + sx, r * 9 + sx + 3)]


def listminus(l1, l2):
    return [v for v in l1 if v not in l2]


def guess(x, y):
    idx = y * 9 + x
    val = sd[idx]
    if val > 0:
        return

    diff = range(0, 10)
    squarelist = square(x, y)
    rowlist = row(y)
    collist = col(x)

    diff = listminus(diff, squarelist)
    diff = listminus(diff, rowlist)
    diff = listminus(diff, collist)

    return diff


def fill(x, y, val):
    global cell, sd
    sd[y * 9 + x] = val

    for idx in range(y * 9, (y + 1) * 9):
        cell[idx]-= set([val])

    for idx in range(x, 81, 9):
        cell[idx]-= set([val])

    for sy in range(y / 3 * 3, (y / 3 + 1) * 3):
        for sx in range(x / 3 * 3, (x / 3 + 1) * 3):
            idx = sy * 9 + sx
            cell[idx]-= set([val])

    drawcell()
    drawsd()


def squareOtherFills(x, y):
    sx = x / 3 * 3
    sy = y / 3 * 3
    ret = set([])
    keys = [i for r in range(sy, sy + 3) for i in xrange(r * 9 + sx, r * 9 + sx + 3) if i != y * 9 + x]
    for idx in keys:
        ret|= cell[idx]

    print x, y, keys, ret
    return ret

def setSquare(sx, sy):
    global sd, cell
    for y in range(sy * 3, sy * 3 + 3):
        for x in range(sx * 3, sx * 3 + 3):
            diff = guess(x, y)
            if None == diff:
                continue

            cell[y * 9 + x] = set(diff)



def guessSquare(sx, sy):
    global sd, cell


    for y in range(sy * 3, sy * 3 + 3):
        for x in range(sx * 3, sx * 3 + 3):
            c = cell[y * 9 + x]

            if (len(c) == 0):
                continue

            if len(c) == 1:
                print "only: ", (x, y), c
                fill(x, y, list(c)[0])
                continue

            diff = range(1, 10)
            diff = listminus(diff, row(y))
            # print (x, y), diff, row(y)
            diff = listminus(diff, col(x))
            diff = listminus(diff, square(x, y))
            if len(diff) == 1:
                print "col row square: ", (x, y), diff[0]
                fill(x, y, diff[0])
                continue

            sqcell = squareOtherFills(x, y)
            diff = c - sqcell
            if len(diff) == 1:
                print "cell: ", (x, y), sqcell, c, list(diff)[0]
                fill(x, y, list(diff)[0])
                continue


def drawsd():
    for y in range(0, 9):
        line = sd[y * 9 : (y + 1) * 9]
        print line
    print


def drawcell():
    for y in range(0, 9):
        line = cell[y * 9 : (y + 1) * 9]
        print line
    print

drawsd()

for sy in range(0, 3):
    for sx in range(0, 3):
        setSquare(sx, sy)

drawcell()

for i in range(0, 5):
    for sy in range(0, 3):
        for sx in range(0, 3):
            guessSquare(sx, sy)


drawsd()
# drawcell()
